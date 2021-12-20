const http = require("./http");
const APIEndpoints = require("./constants").URIs;
const APIException = require("./APIException");
const emitter = require("./emitter");
const fs = require("fs");

class Client {
     token;

     async login(token) {
          if (await Client.isValid(token)) {
               this.token = token;
               emitter.emitter.emit("LOGIN", this);
          } else {
               throw new APIException("Provided token was invalid");
          }
     }

     /**
      *
      * @param {String} token
      * @returns {boolean} Is token valid
      */
     static async isValid(token) {
          const response = await http.get(APIEndpoints.GetName, token);
          /*await fetch(URIs.GetName, {
               method: "GET",
               headers: {
                    authorization: token,
               },
          });*/
          return response.status === 200;
     }

     get name() {
          const response = http.getSync(APIEndpoints.GetName, this.token);
          return response.json.name;
     }

     set name(value) {
          http.patch(
               APIEndpoints.GetName,
               {
                    name: value,
               },
               this.token
          ).then((res) => {
               emitter.emitter.emit(
                    "NAME_CHANGE",
                    this,
                    res.json.previous,
                    value
               );
          });
     }

     on(action, callback) {
          emitter.emitter.on(action, callback);
     }

     off(action) {
          emitter.emitter.off(action);
     }
}

module.exports.Client = Client;
