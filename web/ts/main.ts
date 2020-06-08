import {NewsMain} from './news/NewsMain';
import {LoginMain} from "./login/LoginMain";
import {ClassMain} from './class/ClassMain';
import {CenterMain} from './center/CenterMain';
import {JudokaMain} from './judoka/JudokaMain';
import {GeneralMain} from "./general/GeneralMain";

class Main {
    public static handle(): void {
        NewsMain.handle();
        LoginMain.handle();
        ClassMain.handle();
        CenterMain.handle();
        JudokaMain.handle();
        GeneralMain.handle();
    }
}

Main.handle();
