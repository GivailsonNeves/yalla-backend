const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(modelName, modelNameSingle) {
    console.log("creating repository");
    try {
        const MODEL_FOLDER = `${__dirname}/../app/Repositories/Backend`;
        
        const modelContent = await fs.readFile(`${__dirname}/repository/repository.txt`, 'utf8');
        
        const dataController = namesReplacer(modelContent, modelName, modelNameSingle);
    
        await fs.writeFile(`${MODEL_FOLDER}/${modelName}Repository.php`, dataController,'utf8');
    
        console.log("repository created");
    } catch (e) {
        console.error('models', e)
    }
}

setup('Categories', 'Category');