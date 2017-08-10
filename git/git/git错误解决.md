# Git: solving error "Cannot update paths and switch to branch"

- When trying to create a local branch from a remote one, git may display the following error:

-  fatal: Cannot update paths and switch to branch 'nome-do-branch' at the same time.


- Usually this happens when your local copy of the repository does not have information about the requested branch for some reason. To check this, use the following command:

-  **git remote show origin**

- This will list all branches known for this local repository. If the branch you want to use is not listed, run the command

-  **git remote update**

- This will update all remote branches tracked by your local repository. Then execute

-  **git fetch**

- to simultaneously update all tracked branches.

- Then you can create your local branch with the following checkout command:

-  **git checkout -b nome-do-branch origin/nome-do-branch**

After that you can go take a beer \o/