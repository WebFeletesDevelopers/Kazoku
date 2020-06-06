export class Cookie {
    public static set(name: string, value: string): void {
        document.cookie = `${name}=${value}; path=/`
    }

    public static delete(name: string): void {
        document.cookie = `${name}= ; expires = Thu, 01 Jan 1970 00:00:00 GMT`;
    }
}
