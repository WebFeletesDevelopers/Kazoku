export class Cookie {
    public static set(name: string, value: string): void {
        document.cookie = `${name}=${value}; path=/`
    }
}
