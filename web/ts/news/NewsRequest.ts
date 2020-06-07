import { Request } from "../util/Request";
import { News } from "./News";
import { Response } from "../util/Response";

export class NewsRequest {
    /**
     * Add a new to the database
     * @param news
     */
    public static addNews(news: News): Promise<Response> {
        const data = `title=${news.title}&body=${news.body}&public=${news.public}`;
        return Request.post('/news/add', data);
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
