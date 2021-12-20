class ResponseData {
     /**
      * @type {any}
      */
     json;
     /**
      * @type {number}
      */
     status = 0;

     /**
      * Create response data object
      * @param {any} json
      * @param {number} status
      */
     constructor(json, status) {
          this.json = json;
          this.status = status;
     }
}

module.exports = ResponseData;
