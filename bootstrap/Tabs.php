<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.12.07.
 * Time: 16:35
 */

namespace albertborsos\yii2lib\bootstrap;


use yii\base\InvalidConfigException;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 *
 * Tabs with href attributes
 *
 * Class Tabs
 * @package albertborsos\yii2lib\bootstrap
 */
class Tabs extends \yii\bootstrap\Tabs{

	/**
	 * Renders tab items as specified on [[items]].
	 * @return string the rendering result.
	 * @throws InvalidConfigException.
	 */
	protected function renderItems()
	{
		$headers = [];
		$panes = [];

		if (!$this->hasActiveTab() && !empty($this->items)) {
			$this->items[0]['active'] = true;
		}

		foreach ($this->items as $n => $item) {
			if (!array_key_exists('label', $item)) {
				throw new InvalidConfigException("The 'label' option is required.");
			}
			$encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
			$label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
			$headerOptions = array_merge($this->headerOptions, ArrayHelper::getValue($item, 'headerOptions', []));
			$linkOptions = array_merge($this->linkOptions, ArrayHelper::getValue($item, 'linkOptions', []));

			if (isset($item['items'])) {
				$label .= ' <b class="caret"></b>';
				Html::addCssClass($headerOptions, 'dropdown');

				if ($this->renderDropdown($n, $item['items'], $panes)) {
					Html::addCssClass($headerOptions, 'active');
				}

				Html::addCssClass($linkOptions, 'dropdown-toggle');
				$linkOptions['data-toggle'] = 'dropdown';
				$header = Html::a($label, "#", $linkOptions) . "\n"
					. Dropdown::widget(['items' => $item['items'], 'clientOptions' => false, 'view' => $this->getView()]);
			} else {
				// ha nem dropdown
				$options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
				$options['id'] = ArrayHelper::getValue($options, 'id', $this->options['id'] . '-tab' . $n);

				Html::addCssClass($options, 'tab-pane');
				if (ArrayHelper::remove($item, 'active')) {
					Html::addCssClass($options, 'active');
					Html::addCssClass($headerOptions, 'active');
				}
				$url = ArrayHelper::getValue($linkOptions, 'href', '#');
				if($url == '#' && !isset($linkOptions['data-toggle'])){
					$linkOptions['data-toggle'] = 'tab';
					$url .= $options['id'];
				}
				$header = Html::a($label, $url, $linkOptions);
				if ($this->renderTabContent) {
					$panes[] = Html::tag('div', isset($item['content']) ? $item['content'] : '', $options);
				}
			}

			$headers[] = Html::tag('li', $header, $headerOptions);
		}

		return Html::tag('ul', implode("\n", $headers), $this->options)
		. ($this->renderTabContent ? "\n" . Html::tag('div', implode("\n", $panes), ['class' => 'tab-content']) : '');
	}
} 