---
layout: default
---

Contributing to Bauhaus
---

- [Introduction](#introduction)
- [Bug reports](#bug-reports)
- [Feature requests](#feature-requests)
- [Pull Requests](#pull-requests)

### Introduction

Bauhaus' source is hosted on [Github](https://github.com/krafthaus/bauhaus). it's distributed under the [MIT license](https://github.com/krafthaus/bauhaus/blob/master/LICENSE), so you are free to fork it and do whatever you like with it. If you're doing something awesome with Bauhaus, we'd love to [hear about it!](mailto:hello@krafthaus.nl).

### Bug reports
A bug is a _demonstrable problem_ that is caused by the code in the repository. Good bug reports are extremely helpful - thank you!

Guidelines for bug reports:

1. __Use the GitHub issue search__ - Check if the issue has already been reported.
2. __Check if the issue has been fixed__ - Try to reproduce it using the latest `master` or development branch in this repository.
3. __Isolate the problem__ - Create a [reduced test case](http://css-tricks.com/6263-reduced-test-cases/) and a live example.

A good bug report shouldn't leave others needing to chase you up for more information. Please try to be as detailed as possible in your report. What is your environment? What steps will reproduce the issue? What browser(s) and OS experience the problem?
What would you expect to be the outcome? All these details will help people to fix any potential bugs.

Example:

> Short and descriptive example bug report title
> 
> A summary of the issue and the browser/OS environment in which it occurs. If suitable, include the steps required to reproduce the bug.
> 
> 1. This is the first step
> 2. This is the second step
> 3. Further steps, etc.
> 
> `<url>` - a link to the reduced test case
> 
> Any other information you want to share that is relevant to the issue being reported. This might include the lines of code that you have identified as causing the bug, and potential solutions (and your opinions on their merits).


### Feature requests

Feature requests are welcome. But take a moment to find out whether your idea fits with the scope and aims Bauhaus. It's up to _you_ to make a strong case to convince us of the merits of this feature. Please provide as much detail and context as possible.

### Pull requests

Good pull requests - patches, improvements, new features - are a fantastic help. They should remain focused in scope and avoid containing unrelated commits.

__Please ask first__ before embarking on any significant pull request (e.g. implementing features, refactoring code, porting a different language), otherwise you risk spending a lot of time working on something that we might not want to merge into Bauhaus.

Please adhere to the coding conventions used throughout Bauhaus (indentation, accurate comments, etc.).

Follow this process if you'd like your work considered for inclusion in Bauhaus:

1. Fork Bauhaus, clone your for, and configure the remotes:
```
# Clone your fork if Bauhaus in the current directory
git clone https://github.com/krafthaus/bauhaus
# Navigate to the newly cloned directory
cd <new directory>
# Assign the original repo to a remote called "upstream"
git remote add upstream https://github.com/<upstream-owner>/<repo-name>
```

2. If you cloned a while ago, get the latest changes from upstream:
```
git checkout develop
git pull upstream develop
```

3. Create a new topci branch (off the main project development branch) to contain your feature, change, or fix:
```
git checkout -b <topic-branch-name>
```

4. Commit your changes in logical chunks. Please adhere to these [git commit message guidelines](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html) or your code is unlikely to be merged into the main project. Use Git's [interactive rebase](https://help.github.com/articles/interactive-rebase) feature to tidy up your commits before making them public.

5. Locally merge (or rebase) the upstream develop branch into your topic branch:
```
git pull [--rebase] upstream develop
```

6. Push your topic branch up to your fork:
```
git push origin <topic-branch-name>
```

7. [Open a Pull Request](https://help.github.com/articles/using-pull-requests/) with a clear title and description.