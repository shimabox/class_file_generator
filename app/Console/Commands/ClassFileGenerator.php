<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use View;

class ClassFileGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:classfile-gen
                            {namespace : 名前空間を\'\'で囲って入力してください}
                            {classname : クラス名を入力してください (,区切りで複数作成可能です)}
                            {--p|parent= : 親クラス名を\'\'で囲って入力してください}
                            {--i|interface= : インターフェイス名を\'\'で囲って入力してください}
                            {--u|use= : useするクラス名を\'\'で囲って入力してください (,区切りで複数指定可能です)}
                            {--t|trait= : traitで使うクラス名を\'\'で囲って入力してください}
                            {--nonstrict : declare(strict_types=1); が必要ない場合指定してください}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '与えられた引数に従ってクラスファイルの雛形を作成します';

    /**
     * @var string
     */
    protected $baseDir = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->baseDir = resource_path('commands/classfile_gen');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $namespace  = $this->argument('namespace');
        $classNames = array_map('trim', explode(',', $this->argument('classname')));

        $parent       = $this->option('parent');
        $interface    = $this->option('interface');
        $useClasses   = array_map('trim', explode(',', $this->option('use') ?: ''));
        $traitClasses = implode(', ', array_map('trim', explode(',', $this->option('trait') ?: '')));
        $isStrict     = !$this->option('nonstrict');

        // ファイルの出力先
        $outputDir = $this->baseDir . '/output';

        // viewの探索先を追加
        View::getFinder()->prependLocation($this->baseDir . '/template');

        // $this->baseDir . '/template' 以下から format.blade.php を探してviewインスタンスを生成
        $view = view('format');

        foreach ($classNames as $className) {
            $view
                ->with('namespace', $namespace)
                ->with('classname', $className)
                ->with('parent', $parent ? ' extends ' . $parent : '')
                ->with('interface', $interface ? ' implements ' . $interface : '')
                ->with('useClasses', $useClasses)
                ->with('traitClasses', $traitClasses)
                ->with('isStrict', $isStrict)
                ;

            // 頭に <?php をつけてphpファイルとして出力
            file_put_contents(
                $outputDir . '/' . $className . '.php',
                "<?php\r\r" . $view
            );
        }
    }
}
