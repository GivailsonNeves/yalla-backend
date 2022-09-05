const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(modelName, modelNameSingle) {
    console.log("creating models");
    try {
        const MODEL_FOLDER = `${__dirname}/../app/Models`;
        const fileName = modelNameSingle[0].toUpperCase() + modelNameSingle.substring(1);
        const modelContent = await fs.readFile(`${__dirname}/model/model.txt`, 'utf8');
        
        const dataController = namesReplacer(modelContent, modelName, modelNameSingle);
    
        await fs.writeFile(`${MODEL_FOLDER}/${fileName}.php`, dataController,'utf8');
    ;
        const traitContent = await fs.readFile(`${__dirname}/model/traits-attribute.txt`, 'utf8');
        const dataTableController = namesReplacer(traitContent, modelName, modelNameSingle);
        await fs.writeFile(`${MODEL_FOLDER}/Traits/Attributes/${fileName}Attributes.php`, dataTableController,'utf8');
    
        console.log("models created");
    } catch (e) {
        console.error('models', e)
    }
}

setup('Categories', 'Category');