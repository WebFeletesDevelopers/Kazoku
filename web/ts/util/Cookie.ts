/**
 * Class to use cookies.
 */
export class Cookie {
    /**
     * Set a cookie.
     * @param name
     * @param value
     */
    public static set(name: string, value: string): void {
        document.cookie = `${name}=${value}; path=/`
    }

    /**
     * Get a cookie.
     * @param name
     */
    public static get(name: string): string {
        return document.cookie[name];
    }

    /**
     * Delete a cookie.
     * @param name
     */
    public static delete(name: string): void {
        document.cookie = `${name}= ; expires = Thu, 01 Jan 1970 00:00:00 GMT`;
    }
}
