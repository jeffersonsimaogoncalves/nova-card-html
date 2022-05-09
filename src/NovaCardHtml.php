<?php

namespace SistemaBoss\NovaCardHtml;

use Illuminate\Mail\Markdown;
use Laravel\Nova\Card;

class NovaCardHtml extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'center' => false,
            'withoutCardStyles' => false,
            'forceFullWidth' => false,
            'content' => '',
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-card-html';
    }

    /**
     * Set Markdown code to display in a card (converted into HTML)
     *
     * @param string $htmlContent
     *
     * @return NovaCardHtml
     */
    public function markdown(string $markdownContent): NovaCardHtml
    {
        $htmlContent = Markdown::parse($markdownContent)->toHtml();

        return $this->html($htmlContent);
    }

    /**
     * Set HTML code to display in a card
     *
     * @param string $htmlContent
     *
     * @return NovaCardHtml
     */
    public function html(string $htmlContent): NovaCardHtml
    {
        return $this->withMeta(['content' => $htmlContent]);
    }

    /**
     * Use blade view file to render Card content.
     *
     * @param string $view
     * @param array $viewData
     *
     * @return NovaCardHtml
     */
    public function view(string $view, array $viewData = []): NovaCardHtml
    {
        $htmlContent = view($view, $viewData);

        return $this->html($htmlContent);
    }

    /**
     * Center card's content
     *
     * @param bool $centerContent
     *
     * @return NovaCardHtml
     */
    public function center(bool $centerContent = true): NovaCardHtml
    {
        return $this->withMeta(['center' => $centerContent]);
    }

    /**
     * Force Nova to apply full width for a card.
     * Nova has undocumented feature to auto-order cards based on width and put
     * full-width cards at the bottom. If you want to display full-width cards
     * not at the end, you should use with=1/3 or 2/3 and this method.
     *
     * @see https://github.com/laravel/nova-issues/issues/1895#issuecomment-543684472
     *
     * @param bool $forceFullWidth
     *
     * @return NovaCardHtml
     */
    public function forceFullWidth(bool $forceFullWidth = true): NovaCardHtml
    {
        return $this->withMeta(['forceFullWidth' => $forceFullWidth]);
    }

    /**
     * Whether to use standard Nova Card styles for a card (background, padding, etc)
     *
     * @param bool $withoutStyles
     *
     * @return NovaCardHtml
     */
    public function withoutCardStyles(bool $withoutStyles = true): NovaCardHtml
    {
        return $this->withMeta(['withoutCardStyles' => $withoutStyles]);
    }
}
