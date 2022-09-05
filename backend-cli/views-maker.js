const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(modelName, modelNameSingle) {
    console.log("views events");
    try {

        const EVENT_FOLDER = `${__dirname}/../resources/views/backend/${modelName.toLowerCase()}`;
        fs.mkdir(EVENT_FOLDER, { recursive: true }, (err) => {
            if (err) throw err;
        });
        for( const element of ["create", "edit", "form", "index"]) {
            const modelContent = await fs.readFile(`${__dirname}/views/${element}.txt`, 'utf8');
            
            const data = namesReplacer(modelContent, modelName, modelNameSingle);
        
            await fs.writeFile(`${EVENT_FOLDER}/${element}.blade.php`, data,'utf8');
        }
        console.log("views created");

        console.log('creating includes')
        const EVENT_INCLUDES_FOLDER = `${EVENT_FOLDER}/includes` ;
        fs.mkdir(EVENT_INCLUDES_FOLDER, { recursive: true }, (err) => {
            if (err) throw err;
        });

        for( const element of ["breadcrumb-links", "header-buttons"]) {
            const modelContent = await fs.readFile(`${__dirname}/views/includes/${element}.txt`, 'utf8');
            
            const data = namesReplacer(modelContent, modelName, modelNameSingle);
        
            await fs.writeFile(`${EVENT_INCLUDES_FOLDER}/${element}.blade.php`, data,'utf8');
        }

        console.log("includes created");
        
    } catch (e) {
        console.error('models', e)
    }
}

setup('Categories', 'Category');