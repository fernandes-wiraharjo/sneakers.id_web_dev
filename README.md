
# installation

  

1.  ``` composer install ```

2.  ``` php artisan key:generate ```

3. SETUP your `.env`

4.  ``` php artisan migrate --path=database/migrations/*/* ```

5.  ``` npm install ```

  

Updating `migrations`

``` php artisan migrate:fresh```

``` bila terkena error saat creating table men, maka lanjut dulu```

``` php artisan migrate --path=database/migrations/* ```

``` php artisan migrate --path=database/migrations/*/* ```

``` hapus table men size yang sudah kecreate, kemudian jalanin ulang php artisan migrate```

``` php artisan db:seed ```

  

# Using Library

* hexters/ladmin

* browner12/helpers

* laravel/jetstream

* laravel/sanctum

* laravel/tinker

* livewire/livewire

* nwidart/laravel-modules

  

#TechStack Laravel

* AlphineJS

* Livewire

  

# create new Feature

`php artisan module` for help

  

`php artisan module:make [Feature Name]`

  

`php artisan make:datatables ../../Modules/[Feature Name]/Entities/[Feature Name]Datatables` for making datatables *dont forget change namespace*

  

this repository build with Services, Repositories, Helpers design pattern, you can take care of this architecture by following category module.

build in menu management system, log, login, user role permission or ACL, or etc by hexter/ladmin. you must not concern into this problem and skipped this right?.

  

*happy coding*

  

# naming branch

`[issue_number]#<type>_[feature name]_[point description]`

# Pull Request

```

always create PR after new module or any changes

format PR Name : [Programmer Name] - Changes name

use fixed if fixing issue or any changes

```

# Conventional Commit Messages

See how a minor change to your commit message style can make a difference. [Examples](https://gist.github.com/qoomon/5dfcdf8eec66a051ecd85625518cfd13#examples)

**Have a look at CLI util [git-conventional-commits](https://github.com/qoomon/git-conventional-commits) to ensure this conventions and generate changelogs**

[https://camo.githubusercontent.com/fe332a30e07a5236a0ecfe74b58db1a4c35aa98c0677e946cc7bc63b424dae04/68747470733a2f2f696d672e69636f6e73382e636f6d2f6475736b2f313630302f636f6d6d69742d6769742e706e67](https://camo.githubusercontent.com/fe332a30e07a5236a0ecfe74b58db1a4c35aa98c0677e946cc7bc63b424dae04/68747470733a2f2f696d672e69636f6e73382e636f6d2f6475736b2f313630302f636f6d6d69742d6769742e706e67)

## Commit Formats

### Default

```
<type>(<optional scope>):<subject>empty separator line<optional body>empty separator line<optional footer>

```

### Merge

```
Merge branch '<branch name>'


```

Follows default git merge message

### Types

-   API relevant changes
    -   `feat` Commits, that adds a new feature
    -   `fix` Commits, that fixes a bug
-   `refactor` Commits, that rewrite/restructure your code, however does not change any behaviour
    -   `perf` Commits are special `refactor` commits, that improve performance
-   `style` Commits, that do not affect the meaning (white-space, formatting, missing semi-colons, etc)
-   `test` Commits, that add missing tests or correcting existing tests
-   `docs` Commits, that affect documentation only
-   `build` Commits, that affect build components like build tool, ci pipeline, dependencies, project version, ...
-   `ops` Commits, that affect operational components like infrastructure, deployment, backup, recovery, ...
-   `chore` Miscellaneous commits e.g. modifying `.gitignore`

### Scopes

The `scope` provides additional contextual information.

-   Is an **optional** part of the format
-   Allowed Scopes depends on the specific project
-   Don't use issue identifiers as scopes

### Subject

The `subject` contains a succinct description of the change.

-   Is a **mandatory** part of the format
-   Use the imperative, present tense: "change" not "changed" nor "changes"
    -   Think of `This commit will <subject>`
-   Don't capitalize the first letter
-   No dot (.) at the end

### Body

The `body` should include the motivation for the change and contrast this with previous behavior.

-   Is an **optional** part of the format
-   Use the imperative, present tense: "change" not "changed" nor "changes"
-   This is the place to mention issue identifiers and their relations

### Footer

The `footer` should contain any information about **Breaking Changes** and is also the place to **reference Issues** that this commit refers to.

-   Is an **optional** part of the format
-   **optionally** reference an issue by its id.
-   **Breaking Changes** should start with the word `BREAKING CHANGES:` followed by space or two newlines. The rest of the commit message is then used for this.

### Examples

-   `feat(shopping cart): add the amazing button`
-   `feat: remove ticket list endpoint refers to JIRA-1337 BREAKING CHANGES: ticket enpoints no longer supports list all entites.`
-   `fix: add missing parameter to service call The error occurred because of <reasons>.`
-   `build(release): bump version to 1.0.0`
-   `build: update dependencies`
-   `refactor: implement calculation method as recursion`
-   `style: remove empty line`

## Git Hook Scripts to ensure commit message header format

### commit-msg Hook (local)

-   create following file in your local repository folder`.git-hooks/commit-msg`
    
    `#!/usr/bin/env sh
    
    commit_message="$1"# exit with a non zero exit code incase of an invalid commit message
    
    # use git-conventional-commits, see [https://github.com/qoomon/git-conventional-commits](https://github.com/qoomon/git-conventional-commits)
    
    git-conventional-commits commit-msg-hook "$commit_message"# or verify $commit_message with your own tooling
    
    # ...`
    
-   ⚠ make `.git-hooks/commit-msg` executable (unix: `chmod +x '.git-hooks/commit-msg'`)
    
-   set git hook directory to `.githooks` `git config core.hooksPath '.git-hooks'`
    
-   commit `.git-hooks` directory if you want to share them with your team, they only need to call the git config command once after cloning the repository
    

### pre-receive Hook (server side)

-   create following file in your repository folder `.git/hooks/pre-receive`
    
    `#!/usr/bin/env sh
    
    # Pre-receive hook that will block commits with messges that do not follow regex rule
    
    commit_msg_type_regex='feat|fix|refactor|style|test|docs|build' commit_msg_scope_regex='.{1,20}' commit_msg_subject_regex='.{1,100}' commit_msg_regex="^(${commit_msg_type_regex})(\(${commit_msg_scope_regex}\))?: (${commit_msg_subject_regex})\$" merge_msg_regex="^Merge branch '.+'\$"
    
    zero_commit="0000000000000000000000000000000000000000"# Do not traverse over commits that are already in the repository excludeExisting="--not --all"
    
    error=""while read oldrev newrev refname; do # branch or tag get deleted if [ "$newrev" = "$zero_commit" ]; then continue fi
    
    ```
    # Check for new branch or tag
    if [ "$oldrev" = "$zero_commit" ]; then
      rev_span=`git rev-list $newrev $excludeExisting`else
      rev_span=`git rev-list $oldrev..$newrev $excludeExisting`fi
    
    for commit in $rev_span; do
      commit_msg_header=$(git show -s --format=%s $commit)if ! [[ "$commit_msg_header" =~ (${commit_msg_regex})|(${merge_msg_regex}) ]]; then
        echo "$commit" >&2
        echo "ERROR: Invalid commit message format" >&2
        echo "$commit_msg_header" >&2
        error="true"fi
    done
    
    ```
    
    done
    
    if [ -n "$error" ]; then exit 1 fi`
    
-   ⚠ make `.git/hooks/pre-receive` executable (unix: `chmod +x '.git/hooks/pre-receive'`)

# Conventional Branch
# A Simplified Convention for Naming Branches and Commits in Git

[#git](https://dev.to/t/git)[#beginners](https://dev.to/t/beginners)[#programming](https://dev.to/t/programming)[#github](https://dev.to/t/github)

There are many excellent naming conventions regarding git branches and commits.  
  
But what if you want something very lean and simple?  
  
Here is a proposition.

## [](https://dev.to/varbsan/a-simplified-convention-for-naming-branches-and-commits-in-git-il4#branch-naming-convention)Branch Naming Convention

The  [Git Branching Naming Convention](https://dev.to/couchcamote/git-branching-name-convention-cch)  article is an excellent base.  
However, you can simplify even more.

**Category**  
  
A git branch should start with a category. Pick one of these:  `feature`,  `bugfix`,  `hotfix`, or  `test`.

-   `feature`  is for adding, refactoring or removing a feature
-   `bugfix`  is for fixing a bug
-   `hotfix`  is for changing code with a temporary solution and/or without following the usual process (usually because of an emergency)
-   `test`  is for experimenting outside of an issue/ticket

**Reference**  
  
After the category, there should be a "`/`" followed by the reference of the issue/ticket you are working on. If there's no reference, just add  `no-ref`.

**Description**  
  
After the reference, there should be another "`/`" followed by a description which sums up the purpose of this specific branch. This description should be short and "kebab-cased".  
  
By default, you can use the title of the issue/ticket you are working on. Just replace any special character by "`-`".

**To sum up, follow this pattern when branching:**  

```
git branch <category/reference/description-in-kebab-case>

```

**Examples:**

-   You need to add, refactor or remove a feature:  `git branch feature/issue-42/create-new-button-component`
-   You need to fix a bug:  `git branch bugfix/issue-342/button-overlap-form-on-mobile`
-   You need to fix a bug really fast (possibly with a temporary solution):  `git branch hotfix/no-ref/registration-form-not-working`
-   You need to experiment outside of an issue/ticket:  `git branch test/no-ref/refactor-components-with-atomic-design`
