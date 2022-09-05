const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(modelName, modelNameSingle) {
    console.log("creating breadcrumbs");
    try {
        const MODEL_FOLDER = `${__dirname}/../routes/breadcrumbs/backend/${modelName.toLowerCase()}`;

        fs.mkdir(MODEL_FOLDER, { recursive: true }, (err) => {
            if (err) throw err;
        });
        
        const modelContent = await fs.readFile(`${__dirname}/breadcrumbs/breadcrumb.txt`, 'utf8');
        
        const dataController = namesReplacer(modelContent, modelName, modelNameSingle);
    
        await fs.writeFile(`${MODEL_FOLDER}/${modelNameSingle.toLowerCase()}.php`, dataController,'utf8');
    
        console.log("breadcrumbs created");
    } catch (e) {
        console.error('models', e)
    }
}

setup('Categories', 'Category');