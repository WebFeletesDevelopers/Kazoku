import {Request} from "../util/Request";
import {Judoka} from "./Judoka";
import {Response} from "../util/Response";

export class JudokaRequest {
    /**
     * Add a new to the database
     * @param news
     */
    public static addNews(search: string): Promise<Response> {
        const data = `search=${search}`;
        return Request.post('/judoka/find', data);
    }

    /**
     * Delete a new from the database.
     * @param codNot
     */
    public static deleteNews(codNot: number): Promise<Response>
    {
        const data = `codNot=${codNot}`;
        return Request.post('/news/delete', data);
    }
}
