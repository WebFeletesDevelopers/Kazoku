import { NewsMain } from './news/NewsMain';
import { LoginMain } from "./user/login/LoginMain";
import { ClassMain } from './class/ClassMain';
import { CenterMain } from './center/CenterMain';
import { GeneralMain } from "./general/GeneralMain";
import { UserMain } from "./user/UserMain";
import { TrainerMain } from "./trainer/TrainerMain";

class Main {
    public static handle(): void {
        NewsMain.handle();
        LoginMain.handle();
        ClassMain.handle();
        CenterMain.handle();
        GeneralMain.handle();
        UserMain.handle();
        TrainerMain.handle();
    }
}

Main.handle();
