import { NewsMain } from './news/NewsMain';
import { LoginMain } from "./login/LoginMain";
import { ClassMain } from './class/ClassMain';
import { CenterMain } from './center/CenterMain';

class Main {
    public static handle(): void {
        NewsMain.handle();
        LoginMain.handle();
        ClassMain.handle();
        CenterMain.handle();
    }
}

Main.handle();
