import {NewsMain} from './news/NewsMain';
import {LoginMain} from "./login/LoginMain";

class Main {
    public static handle(): void {
        NewsMain.handle();
        LoginMain.handle();
    }
}

Main.handle();
