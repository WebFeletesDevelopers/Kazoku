import { NewsMain } from './news/NewsMain';
import { LoginMain } from "./user/login/LoginMain";
import { ClassMain } from './class/ClassMain';
import { CenterMain } from './center/CenterMain';
import { GeneralMain } from "./general/GeneralMain";
import { UserMain } from "./user/UserMain";
import { JudokaMain } from './judoka/JudokaMain';
import { TrainerMain } from "./trainer/TrainerMain";
import { AddressMain } from "./address/AddressMain";

class Main {
    public static handle(): void {
        NewsMain.handle();
        LoginMain.handle();
        ClassMain.handle();
        CenterMain.handle();
        JudokaMain.handle();
        GeneralMain.handle();
        UserMain.handle();
        TrainerMain.handle();
        AddressMain.handle();
    }
}

Main.handle();
