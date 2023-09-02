<?php

declare(strict_types = 1);

namespace SimplePie\ApiGen;

use ApiGen\Index\NamespaceIndex;
use ApiGen\Info\ClassLikeInfo;
use ApiGen\Info\ConstantInfo;
use ApiGen\Info\EnumCaseInfo;
use ApiGen\Info\FunctionInfo;
use ApiGen\Info\MemberInfo;
use ApiGen\Info\MethodInfo;
use ApiGen\Info\ParameterInfo;
use ApiGen\Info\PropertyInfo;
use ApiGen\Renderer\UrlGenerator;

use function preg_replace;
use function strlen;
use function strrpos;
use function strtr;
use function substr;

use const DIRECTORY_SEPARATOR;

/**
 * Zola requires Markdown files and uses directories for pages.
 * Assets also need to go to the static directory.
 */
class MdUrlGenerator extends UrlGenerator
{
    public function __construct(
        protected string $baseDir,
        protected string $baseUrl,
    ) {
    }


    protected function toZolaUrl(string $path) {
        return preg_replace('((?:(?:/|^)_index|)\.md$)', '/', $path);
    }


    public function getAssetUrl(string $name): string
    {
        return $this->baseUrl . $this->getAssetPath($name, true);
    }


    public function getAssetPath(string $name, $forUrl = false): string
    {
        return ($forUrl ? '' : '../../static/api/') . "assets/$name";
    }


    public function getIndexUrl(): string
    {
        return $this->baseUrl . $this->toZolaUrl($this->getIndexPath());
    }


    public function getIndexPath(): string
    {
        return '_index.md';
    }


    public function getTreeUrl(): string
    {
        return $this->baseUrl . $this->toZolaUrl($this->getTreePath());
    }


    public function getTreePath(): string
    {
        return 'tree.md';
    }


    public function getNamespaceUrl(NamespaceIndex $namespace): string
    {
        return $this->baseUrl . $this->toZolaUrl($this->getNamespacePath($namespace));
    }


    public function getNamespacePath(NamespaceIndex $namespace): string
    {
        return 'namespace-' . strtr($namespace->name->full ?: 'none', '\\', '.') . '.md';
    }


    public function getClassLikeUrl(ClassLikeInfo $classLike): string
    {
        return $this->baseUrl . $this->toZolaUrl($this->getClassLikePath($classLike));
    }


    public function getClassLikePath(ClassLikeInfo $classLike): string
    {
        return strtr($classLike->name->full, '\\', '.') . '.md';
    }


    public function getFunctionUrl(FunctionInfo $function): string
    {
        return $this->baseUrl . $this->toZolaUrl($this->getFunctionPath($function));
    }


    public function getFunctionPath(FunctionInfo $function): string
    {
        return 'function-' . strtr($function->name->full, '\\', '.') . '.md';
    }


    public function getSourceUrl(string $path, ?int $startLine, ?int $endLine): string
    {
        if ($startLine === null) {
            $fragment = '';

        } elseif ($endLine === null || $endLine === $startLine) {
            $fragment = "#$startLine";

        } else {
            $fragment = "#$startLine-$endLine";
        }

        return $this->baseUrl . $this->toZolaUrl($this->getSourcePath($path)) . $fragment;
    }


    public function getSourcePath(string $path): string
    {
        $relativePath = $this->getRelativePath($path);
        $relativePathWithoutExtension = substr($relativePath, 0, strrpos($relativePath, '.') ?: null);
        return 'source-' . strtr($relativePathWithoutExtension, DIRECTORY_SEPARATOR, '.') . '.md';
    }
}
