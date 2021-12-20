const log = async (s) => {
     for (const c of s) process.stdout.write(c == 1 ? "#" : ".");
     process.stdout.write("\n");
};
const gen = () => {
     const arr = [];
     for (let index = 0; index < 100; index++)
          arr.push(Math.floor(Math.random() * (2 - 0 + 1) + 0));
     return arr;
};
for (let index = 0; index < 100; index++) log(gen());
