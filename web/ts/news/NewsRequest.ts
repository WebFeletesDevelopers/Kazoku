import {Request} from "../util/Request";
import {News} from "./News";

export class NewsRequest {
    public static addNews(news: News)
    {
        const data = `title=${news.title}&body=${news.body}&public=${news.public}`;
        const promise = Request.post('/news/add', data);
        promise.then(res => {console.log(res);console.log(news);});
    }
}
