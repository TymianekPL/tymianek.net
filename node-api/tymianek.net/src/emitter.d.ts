import { ConstantsEvents } from "./client";

export class emitter {
     static on<K extends keyof ConstantsEvents>(eventName: K, handler: (...args: ConstantsEvents[K]) => Awaitable<void>): void;
     static off<K extends keyof ConstantsEvents>(eventName: K): void;
     static emit<K extends keyof ConstantsEvents>(eventName: K, ...args: ConstantsEvents[K]): void;
}

module.exports = emitter;
