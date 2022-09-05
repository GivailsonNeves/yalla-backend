const fs = require('fs').promises;
const namesReplacer = require('./helper');

async function setup(controllerName, controllerNameSingle) {
    console.log("creating controllers");
    try {
        const CONTROLLER_FOLDER = `${__dirname}/../app/Http/Controllers/Backend/${controllerName}`;
        fs.mkdir(CONTROLLER_FOLDER, { recursive: true }, (err) => {
            if (err) throw err;
        });
        const controllerContent = await fs.readFile(`${__dirname}/controllers/controller.txt`, 'utf8');
        
        const dataController = namesReplacer(controllerContent, controllerName, controllerNameSingle);
    
        await fs.writeFile(`${CONTROLLER_FOLDER}/${controllerName}Controller.php`, dataController,'utf8');
    ;
        const tableControllerContent = await fs.readFile(`${__dirname}/controllers/table-controller.txt`, 'utf8');
        const dataTableController = namesReplacer(tableControllerContent, controllerName, controllerNameSingle);
        await fs.writeFile(`${CONTROLLER_FOLDER}/${controllerName}TableController.php`, dataTableController,'utf8');
    
        console.log("controllers created");
    } catch (e) {
        console.error('controllers', e)
    }
}

setup('Categories', 'category');