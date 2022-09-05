const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(modelName, modelNameSingle) {
    console.log("creating events");
    try {

        const EVENT_FOLDER = `${__dirname}/../app/Events/Backend/${modelName}`;
        fs.mkdir(EVENT_FOLDER, { recursive: true }, (err) => {
            if (err) throw err;
        });
        for( const element of ["created", "deleted", "updated"]) {
            const modelContent = await fs.readFile(`${__dirname}/events/${element}.txt`, 'utf8');
            
            const data = namesReplacer(modelContent, modelName, modelNameSingle);
            const fileName = element[0].toUpperCase() + element.substring(1);
        
            await fs.writeFile(`${EVENT_FOLDER}/${modelNameSingle}${fileName}.php`, data,'utf8');
        }
        
        console.log("events created");
    } catch (e) {
        console.error('models', e)
    }
}

setup('Categories', 'Category');