export interface ConstantsEvents {
     LOGIN: [client: Client],
     NAME_CHANGE: [client: Client, now: string, old: string]
}


export class Client {
     public async login(token: string): string;
     public static async isValid(token: string): boolean;
     public name: string;
     public on<K extends keyof ConstantsEvents>(type: K, action: (...args: ConstantsEvents[K]) => Awaitable<void>): void;
     public off<K extends keyof ConstantsEvents>(type: K): void;
}
