document.addEventListener("DOMContentLoaded", () => {

    const project = document.getElementById("oss-project");
    const button = document.getElementById("oss-calc");
    const guide = document.getElementById("oss-size-guide");
    const result = document.getElementById("oss-result");

    const sizeGuide = {
        lesson_bag: "おすすめ：40 × 30cm",
        shoe_bag: "おすすめ：22 × 28cm",
        drawstring: "おすすめ：20 × 25cm",
        tote: "おすすめ：35 × 35cm",
        lunch_bag: "おすすめ：27 × 20 × 10cm",
        cup_bag: "おすすめ：18 × 20cm",
        knapsack: "おすすめ：35 × 40cm"
    };

    function updateGuide() {
        guide.textContent =
            sizeGuide[project.value] ?? "サイズを入力してください";
    }

    updateGuide();

    project.addEventListener("change", updateGuide);

    button.addEventListener("click", () => {

        result.innerHTML = "<p>計算中...</p>";

        const formData = new FormData();

        formData.append("action", "oss_calculate");
        formData.append("nonce", oss.nonce);
        formData.append("type", project.value);
        formData.append(
            "width",
            document.getElementById("oss-width").value
        );
        formData.append(
            "height",
            document.getElementById("oss-height").value
        );
        formData.append(
            "quantity",
            document.getElementById("oss-qty").value
        );
        formData.append(
            "fabric_width",
            document.getElementById("oss-fabric-width").value
        );

        fetch(oss.ajaxUrl, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {

            if (!data.success) {
                result.innerHTML = `
                    <div class="oss-error">
                        ${data.message}
                    </div>
                `;
                return;
            }

            result.innerHTML = `
                <div class="oss-result-card">

                    <h2>${data.title}</h2>

                    <table class="oss-table">

                        <tr>
                            <th>必要な表地</th>
                            <td>${data.fabric} m</td>
                        </tr>

                        <tr>
                            <th>必要な裏地</th>
                            <td>${data.lining} m</td>
                        </tr>

                        <tr>
                            <th>生地幅</th>
                            <td>${data.fabric_width} cm</td>
                        </tr>

                        <tr>
                            <th>裁断サイズ</th>
                            <td>${data.cut_width} × ${data.cut_height} cm</td>
                        </tr>

                        <tr>
                            <th>持ち手</th>
                            <td>${data.handle} cm</td>
                        </tr>

                        <tr>
                            <th>接着芯</th>
                            <td>${data.interfacing} ㎡</td>
                        </tr>

                    </table>

                </div>
            `;
            if (typeof LayoutPreview !== "undefined") {

                const preview = new LayoutPreview("oss-layout");

                preview.draw(data);

            }

        })
        .catch(() => {

            result.innerHTML = `
                <div class="oss-error">
                    通信エラーが発生しました。
                </div>
            `;

        });

    });

});