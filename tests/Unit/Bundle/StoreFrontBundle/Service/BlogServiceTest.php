<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Tests\Unit\StoreFrontBundle\Service;

use PHPUnit\Framework\TestCase;
use Shopware\Bundle\StoreFrontBundle\Gateway\BlogGatewayInterface;
use Shopware\Bundle\StoreFrontBundle\Service\Core\BlogService;
use Shopware\Bundle\StoreFrontBundle\Service\Core\MediaService;
use Shopware\Bundle\StoreFrontBundle\Struct\Blog\Blog;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class BlogServiceTest extends TestCase
{
    public function testSortingShouldBeAsRequest()
    {
        $idPool = [1, 2, 3, 4];
        shuffle($idPool);

        foreach ($idPool as $id) {
            $blog = new Blog();
            $blog->setId($id);
            $blogs[$id] = $blog;
        }

        $gatewayMock = $this->getMockBuilder(BlogGatewayInterface::class)->disableOriginalConstructor()->getMock();
        $gatewayMock->expects($this->once())
            ->method('getList')
            ->will($this->returnValue($blogs));

        $mediaMock = $this->getMockBuilder(MediaService::class)->disableOriginalConstructor()->getMock();
        $contextMock = $this->getMockBuilder(ShopContextInterface::class)->getMock();

        $service = new BlogService($gatewayMock, $mediaMock);

        $data = $service->getList([1, 2, 3, 4], $contextMock);

        $this->assertEquals([1, 2, 3, 4], array_keys($data));
    }
}
