const host = "http://127.0.0.1/";
const baseURI = `${host}api/v1/`;
class URIs {
     static GetToken = `${baseURI}token/account`;
     static GetName = `${baseURI}account/name`;
}
module.exports = {
     host: host,
     baseURI: baseURI,
     URIs: URIs,
};
