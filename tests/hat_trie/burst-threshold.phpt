--TEST--
Adjusting the burst threshold to anything other than default works
--SKIPIF--
<?php
try {
  $trie = new HatTrie;
} catch (TrieException $exp) {
  echo $exp->getMessage();
}
?>
--FILE--
<?php
$trie = new HatTrie(1024);

$trie['foo'] = json_encode(range(1, 250000));
$trie['bar'] = json_encode(range(1, 150000));
$trie['baz'] = json_encode(range(1, 750000));
$trie['fooz'] = json_encode(range(1, 20000));

$begin = hrtime(true);
$trie->prefixSearch('fo');
var_dump(((hrtime(true) - $begin) / 1000000000) < 0.1);
?>
--EXPECT--
bool(true)