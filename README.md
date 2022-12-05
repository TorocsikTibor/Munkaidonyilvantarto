Telepítés:
1. Applikáció beszerzése Github-ról.
2. 'composer install' parancs végrehajtása a parancssor-ban.
3. env fájl létrehozása a 'coy .env.example .env' paranccsal.
4. "app key" generálása 'php artisan key:generate' paranccsal.
5. Fejlesztői környezet indítása például Laragon vagy XAMPP.
6. MySQL adatbázis neve 'munkaidonyilvantarto'.
7. 'php artisan migrate:fresh --seed' parancs futtatása a parancssorban.
8. 'npm run dev' futtatása parancssorban.

Használat:
1. Bejelentkezés / Regisztráció / Kijelentkezés
	-Előre feltöltött felhasználók:
		Admin:
					email: admin@example.com
					jelszó: 123
		Manager:
					email: manager@example.com
					jelszó: 123
		User:
					email: user@example.com
					jelszó: 123

Új felhasználó regisztrálásához a kezdő felületen lehet a 'registration' gombra kattintva.
Regisztrációnál 'user' szerepet kap a felhasználó.

Névre kattintva egy lenyíló fül jelenik meg, ott lehet kijelentkezni.

2. Projekt
Ez az oldal jeleníti meg a jelenlegi projekteket amin lehet dolgozni. Projekteken belül lehet feladatot indítani, ha végzett a feladattal akkor 'stop' gombra kattintva kiírja az eltöltött időt, illetve a névre kattintva tudja szerkeszteni azt.
user: Csak azokat a projekteket látja amihez hozzáadták, 'timer' gombra kattintva tud új feladatot indítani, csak saját feladatot tud szerkeszteni.
manager: Azokat a projekteket látja amihez hozzá van rendelve vagy ő a projekt vezető. Tud létrehozni projektet.
admin: mindenhez van hozzáférése.

3. Szabadságok
Különféle szabadságot lehet igényelni.
user: Szabadságot tud igényelni, illetve visszatudja vonni azt.
manager: Szabadságot tud elfogadni vagy elutasítani, döntését vissza is tudja vonni.

4. Menedzser
Saját projekteket tud megtekinteni, szerkeszteni tudja ezeket és különféle statisztikákat kap visszajelzésként mint például ki mennyit dolgozott az adott projekten vagy összesen mennyit dolgoztak. Csak 'manager' szerepű felhasználó tudja elérni az oldalt, vagy az admin

5. Admin
Csak 'admin' jogosultságú személy érheti el, táblázat rendszerbe tudja módosítani az adatbázisban szerelő adatokat.