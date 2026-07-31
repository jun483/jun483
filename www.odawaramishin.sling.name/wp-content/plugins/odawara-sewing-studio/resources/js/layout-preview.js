class LayoutPreview {

    constructor(canvasId) {

        this.canvas = document.getElementById(canvasId);

        if (!this.canvas) {
            return;
        }

        this.ctx = this.canvas.getContext("2d");

    }

    draw(data) {

        if (!this.canvas) {
            return;
        }

        this.ctx.clearRect(
            0,
            0,
            this.canvas.width,
            this.canvas.height
        );

        const layout = data.layout.layout;

        const fabricWidth = data.layout.fabric_width;

        const scale = this.canvas.width / fabricWidth;

        this.canvas.height =
            data.layout.rows *
            data.cut_height *
            scale +
            20;

        this.ctx.fillStyle = "#fafafa";

        this.ctx.fillRect(
            0,
            0,
            this.canvas.width,
            this.canvas.height
        );

        this.ctx.strokeStyle = "#444";

        this.ctx.lineWidth = 2;

        this.ctx.strokeRect(
            0,
            0,
            fabricWidth * scale,
            this.canvas.height
        );

        this.ctx.font = "12px sans-serif";

        layout.forEach(row => {

            row.forEach(piece => {

                const x = piece.x * scale;

                const y = piece.y * scale;

                const w = piece.width * scale;

                const h = piece.height * scale;

                this.ctx.fillStyle = "#d9ecff";

                this.ctx.fillRect(
                    x,
                    y,
                    w,
                    h
                );

                this.ctx.strokeStyle = "#666";

                this.ctx.strokeRect(
                    x,
                    y,
                    w,
                    h
                );

                this.ctx.fillStyle = "#000";

                this.ctx.fillText(
                    `${piece.width}×${piece.height}`,
                    x + 5,
                    y + 18
                );

            });

        });

    }

}

window.LayoutPreview = LayoutPreview;