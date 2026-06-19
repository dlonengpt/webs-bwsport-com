<?php

/**
 * 渲染链接卡片组件，生成转义后的 HTML 片段。
 * 支持自定义标题、描述、图标和链接。
 */
class LinkCard
{
    /**
     * @var string 卡片标题
     */
    private string $title;

    /**
     * @var string 卡片描述
     */
    private string $description;

    /**
     * @var string 卡片链接
     */
    private string $url;

    /**
     * @var string 卡片图标（FontAwesome 类名或图片 URL）
     */
    private string $icon;

    /**
     * @var array 其他属性（如 data-* 等）
     */
    private array $attributes;

    /**
     * 构造函数
     *
     * @param string $title       卡片标题
     * @param string $description 卡片描述
     * @param string $url         卡片链接
     * @param string $icon        卡片图标（可选）
     * @param array  $attributes  额外 HTML 属性（可选）
     */
    public function __construct(
        string $title = '',
        string $description = '',
        string $url = '#',
        string $icon = 'fas fa-link',
        array $attributes = []
    ) {
        $this->title       = $title;
        $this->description = $description;
        $this->url         = $url;
        $this->icon        = $icon;
        $this->attributes  = $attributes;
    }

    /**
     * 设置标题
     *
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * 设置描述
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * 设置链接
     *
     * @param string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * 设置图标
     *
     * @param string $icon
     * @return self
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * 设置额外属性
     *
     * @param array $attributes
     * @return self
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * 生成卡片 HTML
     *
     * @return string 转义后的 HTML 片段
     */
    public function render(): string
    {
        $escapedTitle       = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl         = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedIcon        = htmlspecialchars($this->icon, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $attrStr = '';
        foreach ($this->attributes as $key => $value) {
            $escapedKey   = htmlspecialchars($key, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $escapedValue = htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $attrStr     .= ' ' . $escapedKey . '="' . $escapedValue . '"';
        }

        $html = <<<HTML
<a href="{$escapedUrl}" class="link-card"{$attrStr}>
    <div class="link-card-icon">
        <i class="{$escapedIcon}"></i>
    </div>
    <div class="link-card-content">
        <span class="link-card-title">{$escapedTitle}</span>
        <span class="link-card-description">{$escapedDescription}</span>
    </div>
</a>
HTML;

        return $html;
    }

    /**
     * 快速创建并渲染卡片（静态方法）
     *
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $icon
     * @param array  $attributes
     * @return string
     */
    public static function create(
        string $title,
        string $description,
        string $url = '#',
        string $icon = 'fas fa-link',
        array $attributes = []
    ): string {
        $card = new self($title, $description, $url, $icon, $attributes);
        return $card->render();
    }
}

// 示例：宝威体育品牌链接卡片
$baoweiCard = LinkCard::create(
    '宝威体育',
    '专业体育赛事平台，尽享竞技魅力',
    'https://webs-bwsport.com',
    'fas fa-running',
    ['target' => '_blank', 'rel' => 'noopener noreferrer']
);

// 输出卡片 HTML（已转义）
echo $baoweiCard;