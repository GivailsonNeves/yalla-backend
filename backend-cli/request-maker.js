const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(modelName, modelNameSingle) {
    console.log("creating requests");
    try {

        const EVENT_FOLDER = `${__dirname}/../app/Http/Requests/Backend/${modelName}`;
        fs.mkdir(EVENT_FOLDER, { recursive: true }, (err) => {
            if (err) throw err;
        });
        for( const element of ["create", "delete", "update", "manage", "store", "edit"]) {
            const modelContent = await fs.readFile(`${__dirname}/requests/${element}.txt`, 'utf8');
            
            const data = namesReplacer(modelContent, modelName, modelNameSingle);
        
            const fileName = `${element[0].toUpperCase() + element.substring(1)}${modelName}Request`;

            await fs.writeFile(`${EVENT_FOLDER}/${fileName}.php`, data,'utf8');
        }
        
        console.log("requests created");
    } catch (e) {
        console.error('models', e)
    }
}

setup('Categories', 'Category');