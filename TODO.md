### TODO

- [x] Clear useless reserved keywords (e.g. for primitive types)
- [x] Replace `[]` by `begin` ... `end`
- [x] Use `do` notation for expressions as statements and to avoid separators
- [x] Implement `for` loop
- [x] Remove the necessity of 'begin' in if/while/for/foreach statements
- [x] Object access syntax should use (.) instead of (:)
- [x] Re-implement atoms
- [x] Implement post-conditionals for expression statements
- [x] Implement function invocation
- [x] Implement array access
- [x] Implement when notation
- [x] Implement booleans as expressions
- [x] Implement nil as expression
- [x] Distinguish double from integer
- [x] Store numbers as strings instead of integers
- [x] Make a sandwich (because I'm hungry)
- [x] Implement strings as expressions
- [x] Implement `<expr> .. <expr> by <expr>` syntax
- [x] Implement atoms as expressions
- [x] Create a single parselet for literal values
- [x] Verify associative array definitions
- [x] Implement short syntax for `open` statements
- [x] Make print an expression and stdout an alias for echo
- [x] Implement partial function parsing
- [x] Make do-notation accept multiple expressions
- [x] Make let-notation accept multiple definitions
- [x] Implement where-clause
- [x] Make function-def be a statement. Fix parsing
- [x] Verify property definitions for classes
- [x] Fix line-0-bug
- [x] Better syntax error output
- [x] Fix column count on string
- [x] Ignore comments
- [x] Implement built-in support for regexes
- [x] Support for `super` and `self` call
- [x] Implement enum
- [x] Implement support for parenthesized expressions
- [x] Use INI directives and build a quack.ini file
- [x] Fix bug on break (consuming tokens it shouldn't)
- [x] Implement "Did you mean ..."
- [x] Implement key value in foreach
- [x] Implement hints
- [x] Make attribution optional in let stmt
- [x] Make (!) reference CallParselet
- [x] Tell bang (!) from 0-size call ([])
- [x] Review syntactic sugar for statements (when, unless)
- [x] Review where-notation on expressions. Add as postfix instead of syntactic sugar
- [x] Disambiguate maps/objects/arrays
- [x] Remove T_PARAM
- [x] Implement support for first-class blocks
- [x] Allow lambdas to have statements
- [x] Fix column counter bug { (in atom), (column 0) } on error reporting
- [x] Try again to implement multiple parenthesis level
- [ ] Review precedence and associativity. Make them standard

- Scope
  - [x] Implement a logic for some nodes to carry information about line and column
  - [x] Migrate for classes

- Implement rust data structures model
  - [x] Implement traits
  - [x] Implement structs
  - [x] Rename extensions to impl
  - [x] Implement impl for traits
  - [x] Remove init clause

- Implement formatting in the AST for:
  - [x] AccessExpr
  - [x] ArrayExpr
  - [x] ArrayPairExpr
  - [x] AtomExpr
  - [x] BoolExpr
  - [x] CallExpr
  - [x] IncludeExpr
  - [x] LambdaExpr
  - [x] NameExpr
  - [x] NewExp
  - [x] NilExpr
  - [x] NumberExpr
  - [x] OperatorExpr
  - [x] PartialFuncExpr
  - [x] PostfixExpr
  - [x] PrefixExpr
  - [x] RangeExpr
  - [x] RegexExpr
  - [x] StringExpr
  - [x] TernaryExpr
  - [x] WhenExpr
  - [x] BlockStmt
  - [x] BlueprintStmt
  - [x] BreakStmt
  - [x] CaseStmt
  - [x] ConstStmt
  - [x] ContinueStmt
  - [x] ElifStmt
  - [x] EnumStmt
  - [x] ExprStmt
  - [x] ExtensionStmt
  - [x] FnStmt
  - [x] ForeachStmt
  - [x] ForStmt
  - [x] IfStmt
  - [x] LabelStmt
  - [x] LetStmt
  - [x] MemberStmt
  - [x] ModuleStmt
  - [x] OpenStmt
  - [x] RaiseStmt
  - [x] ReturnStmt
  - [x] SwitchStmt
  - [x] TryStmt
  - [x] WhileStmt
  - [x] PostConditionalStmt

- Write tests for statements:

  - [ ] BlockStmt
  - [ ] BlueprintStmt
  - [ ] BreakStmt
  - [ ] CaseStmt
  - [ ] ConstStmt
  - [ ] ContinueStmt
  - [ ] ElifStmt
  - [ ] EnumStmt
  - [ ] ExprStmt
  - [x] ExtensionStmt
  - [ ] FnStmt
  - [ ] ForeachStmt
  - [ ] ForStmt
  - [ ] IfStmt
  - [ ] LabelStmt
  - [ ] LetStmt
  - [x] MemberStmt
  - [ ] ModuleStmt
  - [ ] OpenStmt
  - [ ] RaiseStmt
  - [ ] ReturnStmt
  - [ ] Stmt
  - [ ] SwitchStmt
  - [ ] TryStmt
  - [ ] WhileStmt
  - [x] AccessExpr
  - [x] ArrayExpr
  - [x] ArrayPairExpr
  - [x] AtomExpr
  - [x] BoolExpr
  - [x] CallExpr
  - [x] IncludeExpr
  - [x] LambdaExpr
  - [ ] NameExpr
  - [x] NewExpr
  - [x] NilExpr
  - [ ] NumberExpr
  - [x] OperatorExpr
  - [x] PartialFuncExpr
  - [ ] PostfixExpr
  - [ ] PrefixExpr
  - [x] RangeExpr
  - [ ] RegexExpr
  - [ ] StringExpr
  - [ ] TernaryExpr
  - [ ] WhenExpr
  - [ ] PostConditionalStmt
