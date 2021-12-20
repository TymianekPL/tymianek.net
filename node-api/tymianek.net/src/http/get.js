const ResponseData = require("./responseData");
const fetch = require("node-fetch-commonjs").default;

/**
 * Make an GET request
 * @param {String} uri
 * @param {String} authorization
 * @returns {ResponseData} Response data
 */
async function get(uri, authorization) {
     const body = {
          method: "GET",
          compress: true,
          headers: {
               authorization: authorization,
          },
          mode: "cors",
     };
     const response = await fetch(uri, body).then((res) => res);
     const json = await response.json();
     return new ResponseData(json, response.status);
}

function getSync(uri, authorization) {
     const response = fetch(uri, {
          method: "GET",
          compress: true,
          headers: {
               authorization: authorization,
          },
          redirect: "follow",
          agent: "core/fetch",
     }).then((res) => res);
     const json = response.json().then((res) => res);
     return new ResponseData(json, response.status);
}

module.exports.async = get;
module.exports.Sync = getSync;
