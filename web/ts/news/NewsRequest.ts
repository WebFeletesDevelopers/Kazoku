import { Request } from "../util/Request";
import { News } from "./News";
import { Response } from "../util/Response";

export class NewsRequest {
    public static addNews(news: News): Promise<Response>
    {
        const data = `title=${news.title}&body=${news.body}&public=${news.public}`;
        return Request.post('/news/add', data);
    }
}
