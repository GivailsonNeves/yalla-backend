
module.exports = (data, controllerName, controllerNameSingle) => {

    const controllerNameSingleUpper = controllerNameSingle[0].toUpperCase() + controllerNameSingle.substring(1);

    return data.replace(/Features/g, controllerName)
        .replace(/features/g, controllerName.toLowerCase())
        .replace(/Feature/g, controllerNameSingleUpper)
        .replace(/feature/g, controllerNameSingle.toLowerCase());
}