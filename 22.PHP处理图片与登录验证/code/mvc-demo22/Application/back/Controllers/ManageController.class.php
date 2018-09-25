<?php

/**
 * 后台管理首页相关控制器类
 */
class ManageController extends PlatformController {

	/**
	 * 首页动作
	 */
	public function IndexAction() {
		// 载入视图模板
		require VIEW_PATH . 'index.html';
	}

	public function TopAction() {
		// 载入top模板即可！
		require VIEW_PATH . 'top.html';
	}
	public function MenuAction() {
		// 载入top模板即可！
		require VIEW_PATH . 'menu.html';
	}
	public function DragAction() {
		// 载入top模板即可！
		require VIEW_PATH . 'drag.html';
	}
	public function MainAction() {
		// 载入top模板即可！
		require VIEW_PATH . 'main.html';
	}
}