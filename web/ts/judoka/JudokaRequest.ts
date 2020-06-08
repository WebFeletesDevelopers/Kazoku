import {Request} from "../util/Request";
import {Judoka} from "./Judoka";
import {Response} from "../util/Response";

export class JudokaRequest {
    /**
     * Add a judoka to the database
     * @param news
     */
    public static addNews(search: string): Promise<Response> {
        const data = `search=${search}`;
        return Request.post('/judoka/find', data);
    }

    /**
     * Delete a judoka from the database.
     * @param judokaId
     */
    public static deleteJudoka(judokaId: number): Promise<Response>
    {
        const data = `judokaId=${judokaId}`;
        return Request.post('/judoka/delete', data);
    }
}
