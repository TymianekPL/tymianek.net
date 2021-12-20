const ResponseData = require("./responseData");
const fetch = require("node-fetch-commonjs").default;

/**
 *
 * @param {String} uri
 * @param {any} data
 * @param {String} authorization
 * @returns {ResponseData} Response data
 */
async function patch(uri, data, authorization) {
     const response = await fetch(uri, {
          method: "PATCH",
          compress: true,
          headers: {
               "Content-Type": "application/json",
               authorization: authorization,
          },
          mode: "cors",
          body: JSON.stringify(data),
     });
     const json = await response.json();
     return new ResponseData(json, response.status);
}

module.exports = patch;
