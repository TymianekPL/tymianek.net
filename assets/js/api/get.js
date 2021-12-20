/**
 * Make an GET request
 * @param {String} uri
 * @param {String} authorization
 */
export async function get(uri, authorization) {
     const response = await fetch(uri, {
          method: "GET",
          compress: true,
          headers: {
               "Content-Type": "application/json",
               authorization: authorization,
          },
          mode: "cors",
     });
     if (response.status.toString().startsWith(2))
          console.log(
               `%c[Core/fetch]: %cFetched GET ${uri} with status %c${response.status} %c${response.statusText}`,
               `color: cyan;`,
               `color: white;`,
               `color: #20FF20;`,
               `color: white;`
          );
     else if (response.status.toString().startsWith(1))
          console.log(
               `%c[Core/fetch]: %cFetched GET ${uri} with status %c${response.status} %c${response.statusText}`,
               `color: #008B8B;`,
               `color: white;`,
               `color: #40E0D0;`,
               `color: white;`
          );
     else if (response.status.toString().startsWith(3))
          console.warn(
               `%c[Core/fetch]: %cFetched GET ${uri} with status %c${response.status} %c${response.statusText}`,
               `color: yellow;`,
               `color: #FFFFa0;`,
               "color: #FFFF00",
               `color: #FFFFa0;`
          );
     else
          console.error(
               `%c[Core/fetch]: %cFetched GET ${uri} with status %c${response.status} %c${response.statusText}`,
               `color: red;`,
               `color: #FFa0a0;`,
               "color: #FF0000",
               `color: #FFa0a0;`
          );
     return await response.json();
}
