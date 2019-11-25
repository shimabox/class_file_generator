# class_file_generator
The class file generation by the command of Laravel.

## Help

```sh
$ php artisan command:classfile-gen -h

Description:
  与えられた引数に従ってクラスファイルの雛形を作成します

Usage:
  command:classfile-gen [options] [--] <namespace> <classname>

Arguments:
  namespace                    名前空間を''で囲って入力してください
  classname                    クラス名を入力してください (,区切りで複数作成可能です)

Options:
  -p, --parent[=PARENT]        親クラス名を''で囲って入力してください
  -i, --interface[=INTERFACE]  インターフェイス名を''で囲って入力してください
  -u, --use[=USE]              useするクラス名を''で囲って入力してください (,区切りで複数指定可能です)
  -t, --trait[=TRAIT]          traitで使うクラス名を''で囲って入力してください
      --nonstrict              declare(strict_types=1); が必要ない場合指定してください
  -h, --help                   Display this help message
```
