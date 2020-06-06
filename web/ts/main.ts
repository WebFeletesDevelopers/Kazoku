import { NewsMain } from './news/NewsMain';
import { ClassMain } from './class/ClassMain';
import { CenterMain } from './center/CenterMain';

class Main {
    public static handle(): void {
        NewsMain.handle();
        ClassMain.handle();
        CenterMain.handle();

    }
}

Main.handle();
