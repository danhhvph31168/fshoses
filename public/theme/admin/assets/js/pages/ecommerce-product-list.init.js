var productListAllData = data.map(product => ({
    id: product.id,
    product: {
        img: product.img_thumbnail,
        title: product.name,
        category: product.category.name
    },
    price: {
        regular: product.price_regular,
        sale: product.price_sale,
    },
    sku: product.sku,
    brand: product.brand,
    created_at: product.created_at,
}));

var inputValueJson = sessionStorage.getItem('inputValue');
if (inputValueJson) {
    inputValueJson = JSON.parse(inputValueJson);
    Array.from(inputValueJson).forEach(element => {
        productListAllData.unshift(element);
    });
}

var editinputValueJson = sessionStorage.getItem('editInputValue');
if (editinputValueJson) {
    editinputValueJson = JSON.parse(editinputValueJson);
    productListAllData = productListAllData.map(function (item) {
        if (item.id == editinputValueJson.id) {
            return editinputValueJson;
        }
        return item;
    });
}
document.getElementById("addproduct-btn").addEventListener("click", function () {
    sessionStorage.setItem('editInputValue', "")
})

var productListAll = new gridjs.Grid({
    columns: [
        {
            name: '#',
            width: '40px',
            sort: {
                enabled: false
            },
            data: (function (row) {
                return gridjs.html('<div class="form-check checkbox-product-list">\
					<input class="form-check-input" type="checkbox" value="'+ row.id + '" id="checkbox-' + row.id + '">\
					<label class="form-check-label" for="checkbox-'+ row.id + '"></label>\
				  </div>');
            })
        },
        {
            name: "Product",
            width: "360px",
            data: (function (row) {
                return gridjs.html('<div class="d-flex align-items-center">' +
                    '<div class="flex-shrink-0 me-3">' +
                    '<div class="avatar-sm bg-light rounded p-1"><img src="' + row.product.img + '" alt="" class="img-fluid d-block"></div>' +
                    '</div>' +
                    '<div class="flex-grow-1">' +
                    '<h5 class="fs-14 mb-1"><a href="' + deleteRoute.replace(":id", row.id) + '" class="text-body">' + row.product.title + '</a></h5>' +
                    '<p class="text-muted mb-0">Category : <span class="fw-medium">' + row.product.category + '</span></p>' +
                    '</div>' +
                    '</div>');
            })
        },
        {
            name: 'Price regular',
            width: '101px',
            data: row => row.price,
            formatter: (function (cell) {
                return gridjs.html(cell.regular);
            })
        },
        {
            name: 'Price sale',
            width: '101px',
            data: row => row.price,
            formatter: (function (cell) {
                return gridjs.html(cell.sale);
            })
        },
        { name: "Sku", width: "150px", data: e => e.sku },
        { name: "Brand", width: "80px", data: e => e.brand.name },
        {
            name: "Create at",
            width: "150px",
            data: e => {
                const date = new Date(e.created_at);
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                };
                return date.toLocaleString('en-US', options);
            }
        },
        {
            name: "Action",
            width: "80px",
            data: row => row,
            formatter: function (cell, row) {
                var x = new DOMParser().parseFromString(row._cells[0].data.props.content, "text/html").body.querySelector(".checkbox-product-list .form-check-input").value;
                return gridjs.html(
                    '<div class="dropdown">' +
                    '<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">' +
                    '<i class="ri-more-fill"></i>' +
                    '</button>' +
                    '<ul class="dropdown-menu dropdown-menu-end">' +
                    '<li><a class="dropdown-item" href="' + detailRoute.replace(":id", x) + '">' +
                    '<i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>' +
                    '</li>' +
                    '<li><a class="dropdown-item edit-list" data-edit-id="' + x + '" href="' + editRoute.replace(":id", x) + '">' +
                    '<i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>' +
                    '</li>' +
                    '<li class="dropdown-divider"></li>' +
                    '<li>' +
                    '<a class="dropdown-item remove-list" href="#" data-id=' + x + ' data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>' +
                    // '<form action="' + deleteRoute.replace(":id", x) + '" method="POST" class="d-inline"' +
                    // '<input type="hidden" name="_token" value="' + csrfToken + '">' +
                    // '<input type="hidden" name="_method" value="DELETE">' +
                    // '<button type="submit" class="dropdown-item remove-list" data-bs-toggle="modal" data-bs-target="#removeItemModal">' +
                    // '<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete' +
                    // '</button>' +
                    // '</form>' +
                    '</li>' +
                    '</ul>' +
                    '</div>'
                );
            },
        },
    ],
    className: {
        th: 'text-muted',
    },
    pagination: {
        limit: 10
    },
    sort: false,
    language: {
        noRecords: ""
    },
    data: productListAllData,
}).render(document.getElementById("table-product-list-all"));

// Search product list
var searchProductList = document.getElementById("searchProductList");
searchProductList.addEventListener("keyup", function () {
    var inputVal = searchProductList.value.toLowerCase();
    function filterItems(arr, query) {
        return arr.filter(function (el) {
            return el.product.title.toLowerCase().indexOf(query.toLowerCase()) !== -1
        })
    }

    var filterData = filterItems(productListAllData, inputVal);
    productListAll.updateConfig({
        data: filterData
    }).forceRender();
    checkRemoveItem();
});

// mail list click event
Array.from(document.querySelectorAll('.filter-list a')).forEach(function (filteritem) {
    filteritem.addEventListener("click", function () {
        var filterListItem = document.querySelector(".filter-list a.active");
        if (filterListItem) filterListItem.classList.remove("active");
        filteritem.classList.add('active');

        var filterItemValue = filteritem.querySelector(".listname").innerHTML

        var filterData = productListAllData.filter(filterlist => filterlist.product.category === filterItemValue);

        productListAll.updateConfig({
            data: filterData
        }).forceRender();
        checkRemoveItem();
    });
})

// price range slider
var slider = document.getElementById('product-price-range');

noUiSlider.create(slider, {
    start: [0, 20000000], // Handle start position
    step: 1000, // Slider moves in increments of '1000'
    margin: 20, // Handles must be more than '20' apart
    connect: true, // Display a colored bar between the handles
    behaviour: 'tap-drag', // Move handle on tap, bar is draggable
    range: { // Slider can select '0' to '100'
        'min': 0,
        'max': 20000000
    },
    format: wNumb({ decimals: 0, prefix: 'VND ' })
});

var minCostInput = document.getElementById('minCost'),
    maxCostInput = document.getElementById('maxCost');

var filterDataAll = '';

// When the slider value changes, update the input and span
slider.noUiSlider.on('update', function (values, handle) {
    var productListupdatedAll = productListAllData;
    if (handle) {
        maxCostInput.value = values[handle];

    } else {
        minCostInput.value = values[handle];
    }

    var maxvalue = parseFloat(maxCostInput.value.replace('VND ', '').replace(',', ''));
    var minvalue = parseFloat(minCostInput.value.replace('VND ', '').replace(',', ''));

    filterDataAll = productListupdatedAll.filter(
        product => parseFloat(product.price.regular) >= minvalue && parseFloat(product.price.regular) <= maxvalue
    );
    productListAll.updateConfig({
        data: filterDataAll
    }).forceRender();
    checkRemoveItem();
});


minCostInput.addEventListener('change', function () {
    slider.noUiSlider.set([null, this.value]);
});

maxCostInput.addEventListener('change', function () {
    slider.noUiSlider.set([null, this.value]);
});

// text inputs example
var filterChoicesInput = new Choices(
    document.getElementById('filter-choices-input'),
    {
        addItems: true,
        delimiter: ',',
        editItems: true,
        maxItemCount: 10,
        removeItems: true,
        removeItemButton: true,
    }
)

// sidebar filter check
Array.from(document.querySelectorAll(".filter-accordion .accordion-item")).forEach(function (item) {
    var isFilterSelected = item.querySelectorAll(".filter-check .form-check .form-check-input:checked").length;
    item.querySelector(".filter-badge").innerHTML = isFilterSelected;
    Array.from(item.querySelectorAll(".form-check .form-check-input")).forEach(function (subitem) {
        var checkElm = subitem.value;
        if (subitem.checked) {
            filterChoicesInput.setValue([checkElm]);
        }
        subitem.addEventListener("click", function (event) {
            if (subitem.checked) {
                isFilterSelected++;
                item.querySelector(".filter-badge").innerHTML = isFilterSelected;
                (isFilterSelected > 0) ? item.querySelector(".filter-badge").style.display = 'block' : item.querySelector(".filter-badge").style.display = 'none';
                filterChoicesInput.setValue([checkElm]);

            } else {
                filterChoicesInput.removeActiveItemsByValue(checkElm);
            }
        });
        filterChoicesInput.passedElement.element.addEventListener('removeItem', function (event) {
            if (event.detail.value == checkElm) {
                subitem.checked = false;
                isFilterSelected--;
                item.querySelector(".filter-badge").innerHTML = isFilterSelected;
                (isFilterSelected > 0) ? item.querySelector(".filter-badge").style.display = 'block' : item.querySelector(".filter-badge").style.display = 'none';
            }
        }, false);
        // clearall
        document.getElementById("clearall").addEventListener("click", function () {
            subitem.checked = false;
            subitem.checked = false;
            filterChoicesInput.removeActiveItemsByValue(checkElm);
            isFilterSelected = 0;
            item.querySelector(".filter-badge").innerHTML = isFilterSelected;
            (isFilterSelected > 0) ? item.querySelector(".filter-badge").style.display = 'block' : item.querySelector(".filter-badge").style.display = 'none';
            productListAll.updateConfig({
                data: productListAllData
            }).forceRender();
        });
    });
});

// Search Brands Options
var searchBrandsOptions = document.getElementById("searchBrandsList");
searchBrandsOptions.addEventListener("keyup", function () {
    var inputVal = searchBrandsOptions.value.toLowerCase();
    var searchItem = document.querySelectorAll("#flush-collapseBrands .form-check");
    Array.from(searchItem).forEach(function (elem) {
        var searchBrandsTxt = elem.getElementsByClassName("form-check-label")[0].innerText.toLowerCase();
        elem.style.display = searchBrandsTxt.includes(inputVal) ? "block" : "none";
    })
});

var isSelected = 0;
function checkRemoveItem() {
    var tabEl = document.querySelectorAll('a[data-bs-toggle="tab"]');
    Array.from(tabEl).forEach(function (el) {
        el.addEventListener('show.bs.tab', function (event) {
            isSelected = 0;
            document.getElementById("selection-element").style.display = 'none';
        });
    });
    setTimeout(function () {
        Array.from(document.querySelectorAll(".checkbox-product-list input")).forEach(function (item) {
            item.addEventListener('click', function (event) {
                if (event.target.checked == true) {
                    event.target.closest('tr').classList.add("gridjs-tr-selected");
                } else {
                    event.target.closest('tr').classList.remove("gridjs-tr-selected");
                }

                var checkboxes = document.querySelectorAll('.checkbox-product-list input:checked');
                isSelected = checkboxes.length;

                if (event.target.closest('tr').classList.contains("gridjs-tr-selected")) {
                    document.getElementById("select-content").innerHTML = isSelected;
                    (isSelected > 0) ? document.getElementById("selection-element").style.display = 'block' : document.getElementById("selection-element").style.display = 'none';
                } else {

                    document.getElementById("select-content").innerHTML = isSelected;
                    (isSelected > 0) ? document.getElementById("selection-element").style.display = 'block' : document.getElementById("selection-element").style.display = 'none';
                }
            });
        });
        removeItems();
        removeSingleItem();
    }, 100);
}

// check to remove item
var checkboxes = document.querySelectorAll('.checkbox-wrapper-mail input');

function removeItems() {
    var removeItem = document.getElementById('removeItemModal');
    removeItem.addEventListener('show.bs.modal', function (event) {
        isSelected = 0;
        document.getElementById("delete-product").addEventListener("click", function () {
            Array.from(document.querySelectorAll(".gridjs-table tr")).forEach(function (element) {
                var filtered = '';
                if (element.classList.contains("gridjs-tr-selected")) {
                    var getid = element.querySelector('.form-check-input').value;
                    function arrayRemove(arr, value) {
                        return arr.filter(function (ele) {
                            return ele.id != value;
                        });
                    }
                    var filtered = arrayRemove(productListAllData, getid);
                    var filteredPublished = arrayRemove(productListPublishedData, getid);
                    productListAllData = filtered;
                    productListPublishedData = filteredPublished;
                    element.remove();
                }
            });
            document.getElementById("btn-close").click();
            if (document.getElementById("selection-element")) {
                document.getElementById("selection-element").style.display = 'none';
            }


            checkboxes.checked = false;
        });
    })
}

function removeSingleItem() {
    var getid = 0;
    Array.from(document.querySelectorAll(".remove-list")).forEach(function (item) {
        item.addEventListener('click', function (event) {
            getid = item.getAttribute('data-id');
            document.getElementById("delete-product").addEventListener("click", function () {
                fetch(deleteRoute.replace(":id", getid), {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded', // Đảm bảo dữ liệu được gửi dưới dạng form
                    },
                    body: new URLSearchParams({
                        _token: csrfToken,
                        _method: "DELETE", // Giả lập phương thức DELETE trong Laravel
                    })
                })
                    .then(response => {
                        if (response.ok) {
                            console.log("Xóa sản phẩm thành công");

                            productListAllData = productListAllData.filter(function (ele) {
                                return ele.id != getid;
                            });

                            // Tìm và xóa dòng tương ứng trong DOM
                            var element = item.closest(".gridjs-tr");
                            if (element) {
                                element.remove();
                            }
                        } else {
                            console.log("Không thể xóa sản phẩm");
                            // Tùy chọn: Hiển thị thông báo lỗi
                        }
                    })
                    .catch(error => {
                        console.error("Lỗi khi xóa sản phẩm:", error);
                        // Tùy chọn: Hiển thị thông báo lỗi
                    });
                function arrayRemove(arr, value) {
                    return arr.filter(function (ele) {
                        return ele.id != value;
                    });
                }
            });
        });
    });


    var getEditid = 0;
    Array.from(document.querySelectorAll(".edit-list")).forEach(function (elem) {
        elem.addEventListener('click', function (event) {
            getEditid = elem.getAttribute('data-edit-id');

            productListAllData = productListAllData.map(function (item) {
                if (item.id == getEditid) {

                    sessionStorage.setItem('editInputValue', JSON.stringify(item));
                }
                return item;
            });
        });
    });
}