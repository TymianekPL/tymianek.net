module.exports = {
     get: require("./get").Sync,
     getSync: require("./get").async,
     post: require("./post"),
     patch: require("./patch"),
     ResponseData: require("./responseData"),
};
