const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(modelName, modelNameSingle) {
    console.log("creating routes");
    try {
        const MODEL_FOLDER = `${__dirname}/../routes/backend`;
        
        const modelContent = await fs.readFile(`${__dirname}/routes/route.txt`, 'utf8');
        
        const dataController = namesReplacer(modelContent, modelName, modelNameSingle);
    
        await fs.writeFile(`${MODEL_FOLDER}/${modelName}.php`, dataController,'utf8');
    
        console.log("routes created");
    } catch (e) {
        console.error('models', e)
    }
}

setup('Categories', 'Category');