<?php
/**
 * 可以灵活定制的分页类
 * 
 * 可以定制的选项包括，分页链接显示效果，当前页码链接按钮的样式，URL中获取分页值的名字，可以随意带自己的参数
 * 
 * 使用方法：
 * 1、初始化类的时候需要传入参数，类型为数组。
 * array(
 * 	(必填)'totalRows'=>'100', 需要显示的数据的总条数；
 * 	(必填)'pageSize'=>'2', 每页需要显示的代码数量；
 * 	(必填)'currentPage'=>$_GET['p'], 当前页码，默认可以通过$_GET['p']获取，其中名字p可以定制
 * 	(必填)'baseUrl'=>'/welcome?id=3',你当前页面的链接地址，比如为http://www.xxx.com/test.php(或者/test.php),如果后面带有参数则可以为http://www.xxx.com/test?id=8
 * 	(选填，默认为3)'offset'=>'3', 当前页码的左右偏移量，比如当前页码为5，则在5的左右各显示几个数字链接，默认为3个，则效果为2,3,4,5,6,7,8
 * 	(选填，默认为p)'pageString'=>'p',通过$_GET['p']获取当前页码时候的名字，默认为p
 * 	(选填,默认为here)'className'=>'here',当前页码链接按钮的样式，默认样式名为here，所以你可以这样写css样式.here{background:#FF4500;} )
 * 
 * 2、可以使用的方法。
 *  A、初始化类后，需要调用pagination([$style = '1'][,$output=TRUE])方法产生分页链接
 *  关于参数的说明：
 *  @param $style (默认为 1,可不填写) ：获取链接全部组件,即 首页+上一页+数字链接+下一页+尾页
 *  @param $style == 2 ：仅获取数字链接
 *  @param $style == 3 ：仅获取上一页+下一页
 *  @param $style == 4 ：仅获取上一页+数字链接+下一页，(不包含首尾页)
 *  
 *  @param $output (默认为TRUE)，返回分页链接
 *  @param $output 为FALSE时，直接输出分页链接
 *  
 *  B、getCurrentPage()获取当前页码，经过真伪判断后的，防止用户自行输入错误，比如http://www.xxx.com/test?p=-100;此时通过此方法获取当前页码为1
 *  
 *  C、pageAmount()获取总的页码数量
 *  
 * @author 星空幻颖
 * @link http://blog.sina.com.cn/yanyinghq
 *
 */
class Page
{
	private $pageSize; //您的网站每一页显示的列表条数
	private $totalRows; //通过数据库查询返回的总的记录条数
	private $url; //基准URL
	private $pageAmount; //页码的总数
	private $currentPage; //当前的页码
	private $offset = 4; //页码偏移量
	private $pageString = 'p'; //页码在URL中的名字
	private $classHere = 'class="here"'; //当前页链接的class样式类名，默认为here
	
	//初始化当前页码，记录总条数，每页多少条记录
	public function __construct($param)
	{
		$this->pageSize = $param['pageSize'];
		$this->totalRows = $param['totalRows'];
		$this->url = $param['baseUrl'];
		$this->offset = !empty($param['offset'])?$param['offset']:$this->offset;
		$this->pageString =  !empty($param['pageString'])?$param['pageString']:$this->pageString;
		$this->classHere = !empty($param['className'])?$param['className']:$this->classHere;
		$this->currentPage = (int)$param['currentPage'];
	}
	
	/**
	 * 创建分页链接
	 * 
	 * @param $style 默认为 1 ：获取链接全部组件
	 * @param $style == 2 ：仅获取数字链接
	 * @param $style == 3 ：仅获取上一页，下一页
	 * @param $style == 4 ：仅获取上一页、下一页、数字链接，不包含首尾页
	 * 
	 * @param $output 为TRUE时，返回分页链接
	 * @param $output 为FALSE时，直接输出分页链接
	 * 
	 */
	public function pagination($style = '1',$output=TRUE)
	{
		$this->baseUrl();
		$this->pageAmount();
		$this->currentPage();
			
		//获取全部组件
		if($style == '1')
		{
			$page = $this->indexPage().$this->prevPage().$this->pageNumber().$this->nextPage().$this->endPage();
		}
		else if($style == '2')
		{
			//获取纯数字链接
			$page = $this->pageNumber();
		}
		else if($style == '3')
		{
			//只获取上一页下一页
			$page = $this->prevPage().$this->nextPage();
		}
		else if($style =='4')
		{
			//上一页、下一页、数字链接
			$page = $this->prevPage().$this->pageNumber().$this->nextPage();
		}
		
		if($output)
		{
			return $page;
		}
		else
		{
			echo $page;
		}
	}
	
	/**
	 * 获取当前页码
	 * 
	 * @return 当前页码，经过真伪判断的
	 */
	public function getCurrentPage()
	{
		$this->pageAmount();
		$this->currentPage();
		return $this->currentPage;
	}
	
	/**
	 * 计算出所有的页数
	 * 
	 * 可以类外面直接调用此方法返回页码总数
	 * 
	 * @return 页码的总数
	 */
	public function pageAmount()
	{
		$this->pageAmount = ceil( $this->totalRows / $this->pageSize);
		if($this->pageAmount <= 0)
		{
			$this->pageAmount = '1';
		}
		return $this->pageAmount;
	}
	
	/**
	 * 判断基准链接是否携带参数
	 * 
	 * 基准链接为用户提交当前页码链接
	 * 
	 * 如果携带参数，则在链接之后加&p=
	 * 
	 * 如果不携带参数，则直接加?p=
	 */
	private function baseUrl()
	{
		if(preg_match('/\?/', $this->url))
		{
			$this->url = $this->url.'&'.$this->pageString.'=';
		}
		else
		{
			$this->url = $this->url.'?'.$this->pageString.'=';
		}
	}
	
	/**
	 * 验证当前页码的真伪性
	 * 
	 * 如果当前页码小于1或者没有，则默认当前页码为1
	 * 
	 * 如果当前页码大于页码总数，则默认当前页码为页码总数
	 * 
	 */
	private function currentPage()
	{
		if($this->currentPage < 1 || !$this->currentPage)
		{
			$this->currentPage = 1;
		}
		else if(($this->currentPage > $this->pageAmount))
		{
			$this->currentPage = $this->pageAmount;
		}
	}
	
	/**
	 * 首页链接
	 */ 
	private function indexPage()
	{
		if($this->currentPage == 1) return;
		return '<a href="'.$this->url.'1">首页</a>';
	}
	
	/**
	 * 尾页链接
	 */
	private function endPage()
	{
		if($this->currentPage == $this->pageAmount) return;
		return '<a href="'.$this->url.$this->pageAmount.'">尾页</a>';
	}
	
	/**
	 * 上一页
	 */
	private function prevPage()
	{
		if($this->currentPage == 1) return;
		return '<a href="'.$this->url.( $this->currentPage - 1 ).'">上一页</a>';
	}
	
	/**
	 * 下一页
	 */
	private function nextPage()
	{
		if($this->currentPage == $this->pageAmount) return;
		return '<a href="'.$this->url.( $this->currentPage + 1 ).'">下一页</a>';
	}
	
	/**
	 * 中间页码的链接
	 * 
	 */
	private function pageNumber()
	{
		$left ="";
		$right = "";
		
		//如果总记录的条数“大于”所有链接的数量时候
		if($this->pageAmount > ($this->offset * 2 + 1))
		{
			//当前页码距离首页的距离
			$leftNum = $this->currentPage - 1;
			
			//当前页码距离尾页的距离
			$rightNum = $this->pageAmount - $this->currentPage;
			
			//当当前页码距离首页距离不足偏移量offset时候，在右边补齐缺少的小方块
			if( $leftNum < $this->offset)
			{
				//左边的链接
				for($i = $leftNum; $i >= 1 ; $i--)
				{
					$left .= '<a href="'.$this->url.( $this->currentPage - $i ).'">'.( $this->currentPage - $i ).'</a>';
				}
				
				//右边的链接
				for($j = 1; $j <= ($this->offset * 2 - $leftNum); $j++)
				{
					$right .= '<a href="'.$this->url.( $this->currentPage + $j ).'">'.( $this->currentPage + $j ).'</a>';
				}
			}
			else if($rightNum < $this->offset)
			{
				//左边的链接
				for($i = ($this->offset * 2 - $rightNum); $i >= 1 ; $i--)
				{
					$left .= '<a href="'.$this->url.( $this->currentPage - $i ).'">'.( $this->currentPage - $i ).'</a>';
				}
				
				//右边的链接
				for($j = 1; $j <= $rightNum; $j++)
				{
					$right .= '<a href="'.$this->url.( $this->currentPage + $j ).'">'.( $this->currentPage + $j ).'</a>';
				}
			}
			else
			{
				//当前链接左边的链接
				for($i = $this->offset; $i >= 1 ; $i--)
				{
					$left .= '<a href="'.$this->url.( $this->currentPage - $i ).'">'.( $this->currentPage - $i ).'</a>'; 
				}
				
				//当前链接右边的链接
				for($j = 1; $j <= $this->offset; $j++)
				{
					$right .= '<a href="'.$this->url.( $this->currentPage + $j ).'">'.( $this->currentPage + $j ).'</a>';
				}
			}

			return $left.'<a href="'.$this->url.$this->currentPage.'" class="here">'.$this->currentPage.'</a>'.$right;
		}
		else
		{
			$allLink='';
			//当页码总数小于需要显示的链接数量时候，则全部显示出来
			for($j = 1; $j <= $this->pageAmount; $j++)
			{
				 $allLink.='<a href="'.$this->url.$j.'" '.($j == $this->currentPage?$this->classHere:'').'>'.$j.'</a>';
			}
			return $allLink;
		}
	}

}