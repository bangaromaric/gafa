set SERVER=localhost
set USER=root
set PASSWORD=
set BASE=voiture

rem Definition de la date en cours
SETLOCAL
SET JOUR=%date:~-10,2%
SET ANNEE=%date:~-4%
SET MOIS=%date:~-7,2%
SET HEURE=%time:~0,2%
SET MINUTE=%time:~3,2%
SET SECOND=%time:~-5,2%
IF "%time:~0,1%"==" " SET HEURE=0%HEURE:~1,1%

rem Choix du dossier de sauvegarde
SET FOLDER=E:\Sauvegardes\Mysql\voiture

rem Verification de l'existence du dossier (Creation dans le cas contraire)
IF NOT exist "%FOLDER%" md "%FOLDER%"

rem Choix du nom du fichier SQL
SET FILE=%FOLDER%\%BASE%_%ANNEE%%MOIS%%JOUR%_%HEURE%%MINUTE%%SECOND%.sql

@echo Sauvegarde de la base %BASE% dans %FOLDER%\

C:\wamp\bin\mysql\mysql5.6.17\bin\mysqldump.exe --user=%USER% --complete-insert --create-options --quote-names --add-drop-table --opt %BASE% --host=%SERVER% --password=%PASSWORD% > %FILE%