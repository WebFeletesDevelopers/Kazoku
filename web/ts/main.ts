import { NewsMain } from './news/NewsMain';
import { ClassMain } from './class/ClassMain';

class Main {
    public static handle(): void {
        NewsMain.handle();
        ClassMain.handle();

    }
}

Main.handle();
