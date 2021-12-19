const api = await import("./api/index.js");
export class User {
     token;
     constructor(token) {
          if (User.isValid(token)) {
               this.token = token;
               window.localStorage.setItem("token", this.token);
          } else {
               console.error("invalid");
          }
     }

     static async isValid(token) {
          const response = await fetch(api.URIs.GetName, {
               method: "GET",
               headers: {
                    Authorization: token,
               },
          });
          return response.status === 200;
     }

     get name() {
          return (async () => {
               const response = await api.get(api.URIs.GetName, this.token);
               return response.name;
          })();
     }

     static async login(email, password) {
          const json = await api.post(
               api.URIs.GetToken,
               {
                    email: email,
                    password: password,
               },
               "no-token"
          );
          const user =
               new User(json.token).token !== undefined
                    ? new User(json.token)
                    : false;
          return json.token !== null ? user : false;
     }

     static async getCurrent() {
          const user =
               new User(window.localStorage.getItem("token")).token !== "null"
                    ? new User(window.localStorage.getItem("token"))
                    : false;
          return window.localStorage.getItem("token") !== null ? user : false;
     }
}
