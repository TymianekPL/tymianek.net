export const { get } = await import("./get.js");
export const post = (await import("./post.js")).default;
export const URIs = (await import("./constants.js")).URIs;
