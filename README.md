# Remove PDF Meta
PDFのメタデータを削除したコピーを作成します。
メタデータを削除したコピーは、Outputディレクトリに出力します。


## 準備
phpとpdftkのインストールが必要です。
```
brew install pdftk
```

## 実行方法
```
php remove_meta.php {target-file-path} {output-file-name}
```

例
```
php remove_meta.php ~/Downloads/test.pdf removed_test.pdf
```
