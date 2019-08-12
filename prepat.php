<?php
/*

 * Author: Huzaib Shafi
 * Author Website: http://www.shafihuzaib.com

 * The MIT License
 *
 * Copyright 2014 Huzaib Shafi (http://www.shafihuzaib.com).
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

include_once 'header.php';

$url = $_POST['url'];

if ($_POST['encoding'] == '') {
    $encoding = mb_detect_encoding($content);
} else {
    $encoding = $_POST['encoding'];
}
/* Function to get file contents from a given url & return content in UTF-8 */

function file_get_contents_utf8($url, $encoding) {
    $content = file_get_contents($url);
    return preg_replace('/[\n]+/', '<br>', str_replace('&nbsp;', ' ', mb_convert_encoding(htmlspecialchars($content), 'UTF-8', $encoding)));
}
?>
<div align="center">
    <div id="raw-data">
<?php
echo $page = file_get_contents_utf8($url, $encoding);
?>
    </div>
        <?php
        echo 'Using encoding:'.$encoding;
        ?>
</div>
<div class="feed-config">
    <form method="POST" action="pattern.php?file=<?php echo $_GET['file']; ?>">
        <pre>
    <textarea placeholder="Enter global pattern 1" name="out_pattern1"></textarea><textarea placeholder="Enter repeatable pattern 1" name = "pattern1"></textarea>
    <textarea placeholder="Enter global pattern 2" name="out_pattern2"></textarea><textarea placeholder="Enter repeatable pattern 2" name = "pattern2"></textarea>
    <textarea placeholder="Enter global pattern 3" name="out_pattern3"></textarea><textarea placeholder="Enter repeatable pattern 3" name = "pattern3"></textarea>
    <textarea placeholder="Enter global pattern 4" name="out_pattern4"></textarea><textarea placeholder="Enter repeatable pattern 4" name = "pattern4"></textarea>
    <input type="hidden" value="<?php echo $url; ?>" name = "url">
    
    <h2>Feed Configuration</h2>
    <input size="80"  type='text' name='feedTitle' placeholder="Title of the feed" />
    <input size="80"  type='text' name='feedDesc' placeholder="Description of the feed" />
    <input  size="80" type='text' name='feedLink' placeholder="Link of the feed" value="<?php echo $url; ?>" />


    <h2>Feed Item Configuration</h2>
    <input size="80" type='text' name='title' placeholder="Title of the item" />
    <input size="80" type='text' name='description' placeholder="Description of the item" />
    <input size="80" type='text' name='image' placeholder="image of the item" />
    <input size="80" type='text' name='link' placeholder="Link of the item" />
    <input size="80" type='text' name='date' placeholder="date article - if u leave this box in blank u will have problems with the feed /(like: feed reader don't will know which is old or new)/" />
    <input size="80" type='text' name='special_placeholder' placeholder="special area if u need - leave blank if u don't need!" />
    
    
  <input type="submit" />
        </pre>
    </form>
</div>
