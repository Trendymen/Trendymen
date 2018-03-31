<?php include 'header.php' ?>
<?php
/**
 * Created by PhpStorm.
 * User: l2266803
 * Date: 2017/4/29 0029
 * Time: 18:51
 */
include('site.php');
$a=new site();
$a->setUrl('www.fuckyou.com');
$a->setTitle('fuck you');
$a->getUrl();
$a->getTitle();
?>

<?php
abstract class AbstractClass
{
    // 强制要求子类定义这些方法
    abstract protected function getValue();
    abstract protected function prefixValue($prefix);

    // 普通方法（非抽象方法）
    public function printOut() {
        print $this->getValue().'<br>';
    }
}

class ConcreteClass1 extends AbstractClass
{
    public function getValue() {
        return "ConcreteClass1";
    }

    public function prefixValue($prefix) {
        return "{$prefix}ConcreteClass1";
    }
}

class ConcreteClass2 extends AbstractClass
{
    public function getValue() {
        return "ConcreteClass2";
    }

    public function prefixValue($prefix) {
        return "{$prefix}ConcreteClass2";
    }
}

$class1 = new ConcreteClass1;
$class1->printOut();
echo $class1->prefixValue('FOO_').'<br>';

$class2 = new ConcreteClass2;
$class2->printOut();
echo $class2->prefixValue('FOO_').'<br>';
?>

