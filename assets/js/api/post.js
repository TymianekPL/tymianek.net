/**
 *
 * @param {String} uri
 * @param {any} data
 * @param {String} authorization
 * @returns {any} json response
 */
export default async function post(uri, data, authorization) {
     const response = await fetch(uri, {
          method: "POST",
          compress: true,
          headers: {
               "Content-Type": "application/json",
               Authorization: authorization,
          },
          mode: "cors",
          body: JSON.stringify(data),
     });
     if (response.status.toString().startsWith(2))
          console.log(
               `%c[Core/fetch]: %cFetched POST ${uri} with status %c${response.status} %c${response.statusText}`,
               `color: cyan;`,
               `color: white;`,
               `color: #20FF20;`,
               `color: white;`
          );
     else if (response.status.toString().startsWith(4))
          console.warn(
               `%c[Core/fetch]: %cFetched POST ${uri} with status %c${response.status} %c${response.statusText}`,
               `color: yellow;`,
               `color: #FFFF20;`,
               "color: #FFFF00",
               `color: #FFFF20;`
          );
     else
          console.error(
               `%c[Core/fetch]: %cFetched POST ${uri} with status %c${response.status} %c${response.statusText}`,
               `color: red;`,
               `color: #FFa0a0;`,
               "color: #FF0000",
               `color: #FFa0a0;`
          );
     return await response.json();
}
